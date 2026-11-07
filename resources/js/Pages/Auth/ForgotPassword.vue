<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Quên mật khẩu - MiniX" />

        <div class="mb-6">
            <h1 class="text-2xl font-black text-white">Quên mật khẩu</h1>
            <p class="text-sm text-gray-400 mt-1 leading-relaxed">
                Đừng lo lắng! Hãy nhập email tài khoản của bạn, chúng tôi sẽ gửi liên kết để bạn đặt lại mật khẩu mới.
            </p>
        </div>

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-400 bg-green-950/40 border border-green-800 rounded-xl p-3"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <InputLabel for="email" value="Email tài khoản" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="name@example.com"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="pt-2">
                <PrimaryButton
                    class="w-full justify-center bg-[#1C9CEF] hover:bg-[#1A8CD8] text-white font-bold py-3 rounded-full text-sm transition shadow-lg cursor-pointer"
                    :class="{ 'opacity-25 cursor-not-allowed': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing">Đang gửi liên kết...</span>
                    <span v-else>Gửi liên kết đặt lại mật khẩu</span>
                </PrimaryButton>
            </div>

            <div class="text-center pt-2">
                <Link
                    :href="route('login')"
                    class="text-xs text-[#1C9CEF] hover:underline"
                >
                    Quay lại đăng nhập
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
