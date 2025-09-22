<template>
    <div class="mx-auto mt-10 border-rounded text-gray-600 bg-white max-w-fit px-7 py-5 rounded-2xl">
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
                    <OrderStatusIndicator :status="order.status" />
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import mockOrders from "./orders.js";
import OrderStatusIndicator from "./OrderStatusIndicator.vue";
import echo from "../plugins/laravel-echo.js";

const orders = ref(mockOrders);

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
