<template>
    <div>
        <b-navbar variant="faded" type="light">
            <b-container>
                <b-navbar-brand href="/">Survey APP</b-navbar-brand>
            </b-container>
        </b-navbar>
        <template v-if="!authenticating">
            <router-view></router-view>
        </template>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { Component, Vue } from "vue-property-decorator";

@Component
export default class App extends Vue {
    private authenticating = true;

    async mounted() {
        if (localStorage.getItem("token")) {
            axios.defaults.headers.common[
                "Authorization"
            ] = `Bearer ${localStorage.getItem("token")}`;

            await axios({
                url: "/api/v1.0/profile",
            }).catch((err) => {
                if (err.response.status === 401) {
                    localStorage.removeItem("token");
                    window.location.assign("/");
                    return;
                }
            });
            if (["login", "register"].includes(this.$route.name)) {
                this.$router.push({ name: "home" });
            }
        } else {
            console.log("router", this.$route.name);
            if (!["login", "register"].includes(this.$route.name)) {
                this.$router.push({ name: "login" });
            }
        }

        this.authenticating = false;
    }
}
</script>

