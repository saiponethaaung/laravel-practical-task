<template>
    <div>
        <b-container>
            <b-col sm="4" offset-sm="4">
                <b-card title="Login">
                    <b-form @submit.prevent="login">
                        <b-form-group
                            id="input-group-1"
                            label="Email address:"
                            label-for="input-1"
                        >
                            <b-form-input
                                id="input-1"
                                v-model="form.email"
                                type="email"
                                placeholder="Enter email"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <br />
                        <b-form-group
                            id="input-group-2"
                            label="Password:"
                            label-for="input-2"
                        >
                            <b-form-input
                                id="input-2"
                                v-model="form.password"
                                type="password"
                                placeholder="Enter password"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <br />
                        <template v-if="!loading">
                            <b-row>
                                <router-link :to="{ name: 'register' }"
                                    >Register</router-link
                                >
                            </b-row>
                            <br />
                            <b-button type="submit" variant="primary"
                                >Submit</b-button
                            >
                        </template>
                        <template v-else>
                            <b-spinner></b-spinner>
                        </template>
                    </b-form>
                </b-card>
            </b-col>
        </b-container>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { Component, Vue } from "vue-property-decorator";

@Component
export default class LoginPage extends Vue {
    private form = {
        email: "",
        password: "",
    };

    private loading = false;

    async login() {
        if (
            this.loading ||
            this.form.email === "" ||
            this.form.password === ""
        ) {
            return;
        }

        this.loading = true;

        await axios({
            url: "/api/v1.0/auth/login",
            data: this.form,
            method: "post",
        })
            .then((res) => {
                localStorage.setItem("token", res.data.data.token);
                window.location.assign("/");
            })
            .catch((err) => {
                alert(err.response.data.msg || "Failed to login!");
                this.loading = false;
            });
    }
}
</script>
