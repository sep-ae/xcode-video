<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

interface Role {
  name: string;
}

interface User {
  id: number;
  name: string;
  email: string;
  status: string;
  created_at: string;
  roles: Role[];
}

defineProps<{ users: User[] }>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' },
  { title: 'Users', href: '/users' },
];
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 bg-white dark:bg-gray-900 shadow-md rounded-xl">
            <h1 class="text-xl font-bold mb-4">Daftar Users</h1>

            <button> hi</button>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 dark:border-gray-700">
                    <thead class="bg-gray-200 dark:bg-gray-800">
                        <tr>
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Role</th>
                            <th class="border px-4 py-2">Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="border px-4 py-2">{{ user.id }}</td>
                            <td class="border px-4 py-2">{{ user.name }}</td>
                            <td class="border px-4 py-2">{{ user.email }}</td>
                            <td class="border px-4 py-2">{{ user.status }}</td>
                            <td class="border px-4 py-2">
                                <span v-for="role in user.roles" :key="role.name">
                                    {{ role.name }}
                                </span>
                            </td>
                            <td class="border px-4 py-2">{{ new Date(user.created_at).toLocaleDateString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
