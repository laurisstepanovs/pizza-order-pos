<template>
    <table class="mx-auto">
        <thead>
        <tr class="border-b-1 p-5">
            <th class="p-5">ID</th>
            <th class="p-5">Description</th>
            <th class="p-5">Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="order in orders" :key="order.id" class="border-b-1">
            <td class="p-5">{{ order.id }}</td>
            <td class="p-5">{{ order.name }}</td>
            <td class="p-5" :title="`Order: ${order.status}`">
                <div
                    class="flex items-center gap-[10px] font-semibold cursor-pointer"
                    :class="statusToStyleClasses.get(order.status).text"
                >
                    <span class="relative flex size-3">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full"
                            :class="statusToStyleClasses.get(order.status).ping"
                        ></span>
                        <span
                            class="relative inline-flex size-3 rounded-full"
                            :class="statusToStyleClasses.get(order.status).dot"
                        ></span>
                    </span>
                    <span>{{ order.status }}</span>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {onMounted, ref} from "vue";
import mockOrders from "./orders.js";
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: import.meta.env.VITE_REVERB_SCHEME === 'https',
    enabledTransports: ['ws'],
});

const orders = ref(mockOrders);

const statusToStyleClasses = new Map([
    ["Pending", {text: "text-yellow-500", ping: "bg-yellow-400 opacity-75", dot: "bg-yellow-500"}],
    ["Cooking", {text: "text-orange-500", ping: "bg-orange-400 opacity-75", dot: "bg-orange-500"}],
    ["Ready", {text: "text-green-500", ping: "bg-green-400 opacity-75", dot: "bg-green-500"}]
]);

onMounted(() => {
    echo.channel("statuses")
        .listen(".OrderEvent", (e) => {
            const orderToUpdate = orders.value.find(order => order.id === e.orderId);
            if (orderToUpdate) {
                orderToUpdate.status = e.statusName;
            }
        });
});
</script>
