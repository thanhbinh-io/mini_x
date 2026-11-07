<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class BotController extends Controller
{
    /**
     * Display the MiniX AI Bot chat page.
     */
    public function index(Request $request)
    {
        return Inertia::render('Bot/Index', [
            'messages' => $request->session()->get('bot_messages', []),
        ]);
    }

    /**
     * Send a message to the Gemini AI API and append response to conversation.
     */
    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $messages = $request->session()->get('bot_messages', []);

        // 1. Append user's message
        $userMsg = [
            'id' => uniqid('msg_', true),
            'role' => 'user',
            'content' => trim($validated['message']),
            'time' => now()->format('H:i'),
        ];
        $messages[] = $userMsg;

        // 2. Prepare payload for Gemini (last 10 messages for context)
        $historyContents = [];
        foreach (array_slice($messages, -10) as $msg) {
            $historyContents[] = [
                'role' => $msg['role'] === 'user' ? 'user' : 'model',
                'parts' => [
                    ['text' => $msg['content']],
                ],
            ];
        }

        $apiKey = config('services.gemini.key');
        $model = config('services.gemini.model', 'gemini-3.5-flash-lite');

        $aiReply = '';

        if (empty($apiKey)) {
            $aiReply = 'Hệ thống chưa được cấu hình GEMINI_API_KEY. Vui lòng thêm khóa API vào file .env.';
        } else {
            try {
                $user = $request->user();
                $currentTime = now()->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->translatedFormat('H:i:s, l, d/m/Y');
                $userName = $user ? $user->name : 'Người dùng';
                $userHandle = $user ? '@' . $user->username : '';

                $systemPrompt = "Bạn là MiniX AI - Trợ lý trí tuệ nhân tạo thông minh, hiện đại và tinh tế được tích hợp trực tiếp vào mạng xã hội MiniX (nền tảng mạng xã hội lấy cảm hứng từ X / Twitter).

THÔNG TIN NGỮ CẢNH HỆ THỐNG:
- Người dùng đang trò chuyện cùng bạn: {$userName} {$userHandle}
- Thời gian thực tế hiện tại: {$currentTime} (Múi giờ Việt Nam GMT+7)

NGUYÊN TẮC VÀ PHONG CÁCH TRỢ LÝ:
1. Nhận biết thời gian thực: Bạn có nhận thức đầy đủ về thời gian thực tế hiện tại. Khi người dùng hỏi giờ, ngày tháng, hoặc chào hỏi theo buổi (sáng/trưa/chiều/tối), hãy phản hồi chính xác, tự nhiên và thân thiện.
2. Cá nhân hóa & Lịch thiệp: Xưng hô là 'MiniX AI' hoặc 'mình'/'tôi', gọi người dùng một cách gần gũi (thỉnh thoảng dùng tên người dùng khi phù hợp). Giữ thái độ hỗ trợ nhiệt tình, thông minh và chu đáo.
3. Chuyên gia Mạng xã hội MiniX:
   - Thành thạo việc sáng tạo Tweet: viết ngắn gọn, cuốn hút, tối ưu trong 280 ký tự, kết hợp emoji sinh động và gợi ý hashtag (#) chuẩn xu hướng.
   - Gợi ý ý tưởng phát triển nội dung, chủ đề thảo luận, thread phân tích sâu sắc.
4. Năng lực Kỹ thuật & Học thuật:
   - Giải đáp mạch lạc các câu hỏi kiến thức đời sống, khoa học, công nghệ.
   - Hỗ trợ lập trình viên: viết code sạch, giải thích logic, gỡ lỗi (PHP, Laravel, Vue.js, Tailwind CSS, JavaScript...). Luôn bọc code trong Markdown code block có tên ngôn ngữ.
5. Trình bày Markdown chuyên nghiệp: Sử dụng định dạng danh sách gạch đầu dòng, in đậm các ý chính để câu trả lời thoáng, dễ đọc và đi thẳng vào trọng tâm.";

                $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

                $response = Http::timeout(25)
                    ->post($endpoint, [
                        'systemInstruction' => [
                            'parts' => [
                                [
                                    'text' => $systemPrompt
                                ]
                            ]
                        ],
                        'contents' => $historyContents,
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'maxOutputTokens' => 1500,
                        ],
                    ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $aiReply = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa thể trả lời câu hỏi này lúc này.';
                } else {
                    $aiReply = 'Hiện tại dịch vụ AI đang bận hoặc gặp sự cố kết nối (Mã lỗi: ' . $response->status() . '). Bạn vui lòng thử lại sau giây lát!';
                }
            } catch (\Throwable $e) {
                $aiReply = 'Không thể kết nối đến máy chủ AI (Lỗi kết nối mạng). Vui lòng thử lại sau.';
            }
        }

        // 3. Append bot's message
        $botMsg = [
            'id' => uniqid('msg_', true),
            'role' => 'assistant',
            'content' => trim($aiReply),
            'time' => now()->format('H:i'),
        ];
        $messages[] = $botMsg;

        $request->session()->put('bot_messages', $messages);

        return back();
    }

    /**
     * Clear all messages in current session.
     */
    public function clear(Request $request)
    {
        $request->session()->forget('bot_messages');

        return back();
    }
}

