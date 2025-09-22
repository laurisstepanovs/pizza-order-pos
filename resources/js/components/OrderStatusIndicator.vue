<template>
    <div
        class="flex items-center gap-[10px] font-semibold cursor-pointer"
        :class="statusToClasses.get(props.status).text"
    >
        <span class="relative flex size-3">
            <span
                class="absolute inline-flex h-full w-full animate-ping rounded-full"
                :class="statusToClasses.get(props.status).ping"
            ></span>
            <span
                class="relative inline-flex size-3 rounded-full"
                :class="statusToClasses.get(props.status).dot"
            ></span>
        </span>
        <span>{{ props.status }}</span>
    </div>
</template>

<script setup>
import statusToClasses from "./statusToClasses.js";
const props = defineProps({
    status: String,
});
</script>
