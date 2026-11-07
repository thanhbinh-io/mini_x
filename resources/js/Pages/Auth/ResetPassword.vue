<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        default: '',
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email || '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Đặt lại mật khẩu - MiniX" />

        <div class="mb-6">
            <h1 class="text-2xl font-black text-white">Đặt lại mật khẩu mới</h1>
            <p class="text-sm text-gray-400 mt-1">
                Nhập mật khẩu mới để đăng nhập và bảo vệ tài khoản MiniX của bạn.
            </p>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <!-- Email (hiển thị cố định nếu đã có từ link, hoặc cho nhập nếu thiếu) -->
            <div v-if="props.email" class="p-3 bg-gray-900/60 border border-gray-800 rounded-xl">
                <div class="text-xs text-gray-500">Tài khoản đặt lại mật khẩu</div>
                <div class="text-sm font-semibold text-white break-all mt-0.5">{{ form.email }}</div>
            </div>
            <div v-else>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="email@example.com"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Password -->
            <div>
                <InputLabel for="password" value="Mật khẩu mới" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="8 - 16 ký tự, gồm chữ hoa, thường & ký tự đặc biệt"
                />
                <p class="text-xs text-gray-500 mt-1">
                    Yêu cầu: 8 - 16 ký tự, có ít nhất 1 chữ hoa, 1 chữ thường và 1 ký tự đặc biệt (@, #, $, ...)
                </p>
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Password confirmation -->
            <div>
                <InputLabel
                    for="password_confirmation"
                    value="Xác nhận mật khẩu mới"
                />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Nhập lại mật khẩu mới"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <!-- Button submit -->
            <div class="pt-2">
                <PrimaryButton
                    class="w-full justify-center bg-[#1C9CEF] hover:bg-[#1A8CD8] text-white font-bold py-3 rounded-full text-sm transition shadow-lg cursor-pointer"
                    :class="{ 'opacity-25 cursor-not-allowed': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing">Đang cập nhật...</span>
                    <span v-else>Xác nhận và vào trang chủ</span>
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
