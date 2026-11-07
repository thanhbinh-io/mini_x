<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CheckCircle from 'vue-material-design-icons/CheckCircle.vue';

defineProps({
    alreadyVerified: {
        type: Boolean,
        default: false,
    },
    email: {
        type: String,
        default: '',
    },
    name: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <GuestLayout>
        <Head title="Xác thực thành công - MiniX" />

        <div class="text-center py-4">
            <!-- Green Check Icon -->
            <div class="w-16 h-16 rounded-full bg-green-500/10 border border-green-500/30 flex items-center justify-center mx-auto mb-5 text-green-400">
                <CheckCircle :size="36" />
            </div>

            <!-- Title -->
            <h1 class="text-2xl font-black text-gray-900 dark:text-white mb-2">
                {{ alreadyVerified ? 'Tài khoản đã được kích hoạt!' : 'Kích hoạt tài khoản thành công!' }}
            </h1>

            <!-- Description -->
            <p class="text-sm text-gray-600 dark:text-gray-300 max-w-sm mx-auto mb-6 leading-relaxed">
                <span v-if="alreadyVerified">
                    Địa chỉ email <strong class="text-gray-900 dark:text-white">{{ email }}</strong> của bạn đã được xác thực trước đó. Bạn có thể đăng nhập ngay để sử dụng dịch vụ.
                </span>
                <span v-else>
                    Tuyệt vời! Địa chỉ email <strong class="text-gray-900 dark:text-white">{{ email }}</strong> đã được xác minh thành công. Tài khoản của bạn hiện đã sẵn sàng để sử dụng.
                </span>
            </p>

            <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-xs text-gray-500 dark:text-gray-400 mb-6 text-left space-y-1">
                <p class="font-semibold text-gray-700 dark:text-gray-300">💡 Hướng dẫn tiếp theo:</p>
                <p>• Bạn có thể quay lại tab trình duyệt lúc nãy và tiến hành đăng nhập.</p>
                <p>• Hoặc bấm vào nút <strong>"Đăng nhập ngay"</strong> bên dưới để tiếp tục.</p>
            </div>

            <!-- Action Button -->
            <Link
                :href="route('login')"
                class="w-full inline-flex justify-center items-center px-6 py-3 bg-[#1C9CEF] hover:bg-[#1A8CD8] text-white font-bold text-sm rounded-full transition duration-150 shadow-md hover:shadow-lg"
            >
                Đăng nhập ngay
            </Link>
        </div>
    </GuestLayout>
</template>
