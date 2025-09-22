import './bootstrap';
import { createApp } from 'vue';
import OrdersList from './components/OrdersList.vue';

const app = createApp({});

app.component('orders-list', OrdersList);

app.mount('#app');
