<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
    isLocal: {
        type: Boolean,
        default: false,
    },
});

const page = usePage();
const form = useForm({});
const devForm = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const devVerify = () => {
    if (props.isLocal) {
        devForm.post('/email/quick-verify');
    }
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <GuestLayout>
        <Head title="Verify Email - MiniX" />

        <div class="mb-6">
            <h1 class="text-2xl font-black text-white">Xác thực tài khoản của bạn</h1>
            <p class="text-sm text-gray-400 mt-1">
                Cảm ơn bạn đã tham gia MiniX! Một email chứa liên kết kích hoạt đã được gửi tới địa chỉ email của bạn.
            </p>
        </div>

        <div
            class="mb-4 p-3 rounded-xl bg-green-500/10 border border-green-500/30 text-sm font-medium text-green-400"
            v-if="verificationLinkSent"
        >
            ✅ Đã gửi lại liên kết xác thực mới đến hòm thư của bạn! Vui lòng kiểm tra hộp thư đến (hoặc thư mục Spam).
        </div>

        <div
            class="mb-4 p-3 rounded-xl bg-red-500/10 border border-red-500/30 text-sm font-medium text-red-400"
            v-if="page.props.flash?.error"
        >
            {{ page.props.flash.error }}
        </div>

        <div class="p-4 rounded-2xl bg-gray-900 border border-gray-800 text-sm text-gray-300 space-y-2 mb-6">
            <div class="flex items-center gap-2 text-white font-semibold">
                <svg class="w-5 h-5 text-[#1C9CEF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Kiểm tra hòm thư Gmail</span>
            </div>
            <p class="text-xs text-gray-400 leading-relaxed">
                Hãy mở ứng dụng hoặc trang web Gmail, tìm thư từ <strong>MiniX</strong> và nhấn vào nút <strong>"Verify Email Address"</strong> để kích hoạt tài khoản.
            </p>
        </div>

        <form @submit.prevent="submit">
            <div class="flex items-center justify-between gap-4">
                <PrimaryButton
                    class="flex-1 justify-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Gửi lại email xác thực
                </PrimaryButton>

                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-sm font-medium text-gray-400 hover:text-white transition-colors"
                >
                    Đăng xuất
                </Link>
            </div>
        </form>

        <!-- Nút kích hoạt nhanh chỉ hiển thị ở môi trường kiểm thử Local -->
        <div v-if="isLocal" class="mt-8 pt-4 border-t border-gray-800 text-center">
            <p class="text-xs text-gray-500 mb-2">
                Dành cho Giảng viên chấm bài / Môi trường kiểm thử Local:
            </p>
            <button
                type="button"
                @click="devVerify"
                :disabled="devForm.processing"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold text-yellow-400 bg-yellow-400/10 hover:bg-yellow-400/20 border border-yellow-400/30 transition-all cursor-pointer"
            >
                ⚡ Kích hoạt tài khoản ngay (Không cần mở Gmail)
            </button>
        </div>
    </GuestLayout>
</template>
