<template>
    <div class="mx-auto mt-10 border-rounded text-gray-600 bg-white max-w-fit px-7 py-5 rounded-2xl
">
        <table>
            <thead>
            <tr class="border-b-1 border-gray-400">
                <th class="p-2">ID</th>
                <th class="p-2">Description</th>
                <th class="p-2">Status</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders" :key="order.id" class="border-b-1 border-gray-400">
                <td class="p-5">#{{ order.id }}</td>
                <td class="p-5">🍕 {{ order.name }}</td>
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
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import mockOrders from "./orders.js";
import echo from "../plugins/laravel-echo.js";

const orders = ref(mockOrders);

const statusToStyleClasses = new Map([
    ["Pending", {text: "text-yellow-500", ping: "bg-yellow-400 opacity-75", dot: "bg-yellow-500"}],
    ["Cooking", {text: "text-orange-500", ping: "bg-orange-400 opacity-75", dot: "bg-orange-500"}],
    ["Ready", {text: "text-green-500", ping: "bg-green-400 opacity-75", dot: "bg-green-500"}]
]);

onMounted(() => {
    echo.channel("order-status-update")
        .listen(".OrderUpdate", (e) => {
            const orderToUpdate = orders.value.find(order => order.id === e.id);
            if (orderToUpdate) {
                orderToUpdate.status = e.status;
            }
        });
});
</script>
