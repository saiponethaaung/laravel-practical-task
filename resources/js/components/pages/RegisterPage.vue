<template>
    <div>
        <b-container>
            <b-col sm="4" offset-sm="4">
                <b-card title="Register">
                    <b-form @submit.prevent="register">
                        <b-form-group
                            id="input-group-1"
                            label="Name:"
                            label-for="input-1"
                        >
                            <b-form-input
                                id="input-1"
                                v-model="form.name"
                                type="text"
                                placeholder="Enter your name"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <br />
                        <b-form-group
                            id="input-group-2"
                            label="Email address:"
                            label-for="input-2"
                        >
                            <b-form-input
                                id="input-2"
                                v-model="form.email"
                                type="email"
                                placeholder="Enter email"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <br />
                        <b-form-group
                            id="input-group-1"
                            label="Password:"
                            label-for="input-1"
                        >
                            <b-form-input
                                id="input-1"
                                v-model="form.password"
                                type="password"
                                placeholder="Enter password"
                                required
                            ></b-form-input>
                        </b-form-group>
                        <br />
                        <template v-if="!loading">
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
export default class RegisterPage extends Vue {
    private form = {
        email: "",
        name: "",
        password: "",
    };

    private loading = false;

    async register() {
        if (
            this.loading ||
            this.form.email === "" ||
            this.form.password === ""
        ) {
            return;
        }

        this.loading = true;

        await axios({
            url: "/api/v1.0/auth/register",
            data: this.form,
            method: "post",
        })
            .then((res) => {
                this.$router.push({ name: "login" });
            })
            .catch((err) => {
                alert(err.response.data.msg || "Failed to register!");
                this.loading = false;
            });
    }
}
</script>
