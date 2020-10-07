import Vue from 'vue'
import App from './App.vue'
import "./main.css"
import "bulma"
import 'vue-select/dist/vue-select.css';

export const bus = new Vue();
Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
