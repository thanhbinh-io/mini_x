<script setup>
import { ref, computed, watch } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import TwitterLayout from '@/Layouts/TwitterLayout.vue';
import ArrowLeft from 'vue-material-design-icons/ArrowLeft.vue';

const props = defineProps({
    profileUser: {
        type: Object,
        required: true,
    },
    type: {
        type: String,
        default: 'followers', // 'followers' | 'following'
    },
    users: {
        type: [Object, Array],
        default: () => ({ data: [] }),
    },
});

const page = usePage();
const currentUser = computed(() => page.props.auth?.user);
const userList = computed(() => Array.isArray(props.users) ? props.users : (props.users?.data || []));

// Keep track of following state and hover state per user
const followingMap = ref({});
const hoverMap = ref({});

const initFollowingMap = () => {
    userList.value.forEach((u) => {
        followingMap.value[u.id] = !!u.is_following;
    });
};

initFollowingMap();
watch(userList, initFollowingMap, { deep: true });

const isFollowing = (userId) => !!followingMap.value[userId];
const isHovering = (userId) => !!hoverMap.value[userId];

const toggleFollow = async (user) => {
    if (!currentUser.value) {
        router.visit(route('login'));
        return;
    }

    if (currentUser.value.id === user.id) return;

    const prev = followingMap.value[user.id];
    followingMap.value[user.id] = !prev;

    try {
        const res = await axios.post(route('users.follow', user.id));
        if (res.data && typeof res.data.is_following === 'boolean') {
            followingMap.value[user.id] = res.data.is_following;
        }
    } catch (err) {
        // Rollback
        followingMap.value[user.id] = prev;
    }
};
</script>

<template>
    <Head :title="`${profileUser.name} (@${profileUser.username})`" />

    <TwitterLayout>
        <div class="text-gray-900 dark:text-white min-h-screen border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-black transition-colors duration-200">
            <!-- Header bar with Back button -->
            <div class="sticky top-0 bg-white/80 dark:bg-black/80 backdrop-blur-md z-20 flex items-center px-4 py-2 border-b border-gray-200 dark:border-gray-800 space-x-6">
                <Link
                    :href="route('users.profile', profileUser.username)"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-900 dark:text-white transition cursor-pointer"
                >
                    <ArrowLeft fillColor="currentColor" :size="20" />
                </Link>
                <div>
                    <h1 class="text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        {{ profileUser.name }}
                    </h1>
                    <p class="text-xs text-gray-500">
                        @{{ profileUser.username }}
                    </p>
                </div>
            </div>

            <!-- Tab Row -->
            <div class="flex border-b border-gray-200 dark:border-gray-800 text-sm font-bold text-gray-500">
                <Link
                    :href="route('users.followers', profileUser.username)"
                    :class="type === 'followers' ? 'text-gray-900 dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-900/50 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="flex-1 py-3.5 text-center transition cursor-pointer relative"
                >
                    <span>Followers</span>
                    <div
                        v-if="type === 'followers'"
                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-[#1C9CEF] rounded-full"
                    ></div>
                </Link>

                <Link
                    :href="route('users.following', profileUser.username)"
                    :class="type === 'following' ? 'text-gray-900 dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-900/50 hover:text-gray-700 dark:hover:text-gray-300'"
                    class="flex-1 py-3.5 text-center transition cursor-pointer relative"
                >
                    <span>Following</span>
                    <div
                        v-if="type === 'following'"
                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-[#1C9CEF] rounded-full"
                    ></div>
                </Link>
            </div>

            <!-- User List -->
            <div v-if="userList && userList.length > 0" class="divide-y divide-gray-200 dark:divide-gray-800">
                <div
                    v-for="user in userList"
                    :key="user.id"
                    class="flex items-start px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-950 transition"
                >
                    <!-- User Avatar -->
                    <Link :href="route('users.profile', user.username)" class="mr-3 flex-shrink-0">
                        <img
                            :src="user.avatar_url"
                            :alt="user.name"
                            class="w-10 h-10 rounded-full object-cover bg-gray-200 dark:bg-gray-800"
                        />
                    </Link>

                    <!-- User Info & Follow Button -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <Link
                                    :href="route('users.profile', user.username)"
                                    class="font-bold text-gray-900 dark:text-white text-[15px] hover:underline truncate block"
                                >
                                    {{ user.name }}
                                </Link>
                                <p class="text-sm text-gray-500">
                                    @{{ user.username }}
                                </p>
                            </div>

                            <!-- Follow/Following Button (if not own profile) -->
                            <button
                                v-if="currentUser && currentUser.id !== user.id"
                                type="button"
                                @click="toggleFollow(user)"
                                @mouseenter="hoverMap[user.id] = true"
                                @mouseleave="hoverMap[user.id] = false"
                                :class="isFollowing(user.id)
                                    ? (isHovering(user.id) ? 'bg-red-50 dark:bg-red-950/40 border-red-500 dark:border-red-600 text-red-600 dark:text-red-500' : 'bg-white dark:bg-black border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white')
                                    : 'bg-gray-900 hover:bg-black text-white dark:bg-white dark:hover:bg-gray-200 dark:text-black border-transparent shadow-sm'"
                                class="border font-bold text-xs px-4 py-1.5 rounded-full transition cursor-pointer min-w-[96px]"
                            >
                                <span v-if="isFollowing(user.id)">
                                    {{ isHovering(user.id) ? 'Unfollow' : 'Following' }}
                                </span>
                                <span v-else>Follow</span>
                            </button>
                        </div>

                        <!-- User Bio -->
                        <p v-if="user.bio" class="text-sm text-gray-700 dark:text-gray-300 mt-1 whitespace-pre-line leading-snug">
                            {{ user.bio }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="py-16 text-center text-gray-500 text-sm max-w-sm mx-auto px-4">
                <div class="text-xl font-bold text-gray-700 dark:text-gray-200 mb-1">
                    {{ type === 'followers' ? 'Looking for followers?' : 'Be in the know' }}
                </div>
                <p class="text-xs text-gray-500">
                    {{
                        type === 'followers'
                            ? `When someone follows @${profileUser.username}, they'll show up here.`
                            : `Following accounts is an easy way to curate your timeline and know what's happening.`
                    }}
                </p>
            </div>

            <!-- Pagination Controls -->
            <div v-if="users?.links && users.links.length > 3" class="p-6 flex justify-center space-x-2">
                <Link
                    v-for="link in users.links"
                    :key="link.label"
                    :href="link.url || '#'"
                    v-html="link.label"
                    :class="[
                        'px-3.5 py-1.5 rounded-full text-xs font-semibold border transition',
                        link.active ? 'bg-[#1C9CEF] border-[#1C9CEF] text-white' : 'border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800',
                        !link.url ? 'opacity-40 pointer-events-none' : ''
                    ]"
                />
            </div>
        </div>
    </TwitterLayout>
</template>
