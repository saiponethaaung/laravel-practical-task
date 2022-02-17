<template>
    <div>
        <b-form-group>
            <b-form-group
                :id="'string-' + form.content.id"
                :label="form.content.name"
                :label-for="'string-form-' + form.content.id"
            >
                <b-form-input
                    v-model="form.answer"
                    :id="'string-form-' + form.content.id"
                    type="text"
                    :placeholder="placeholderText"
                    :disabled="loading"
                    required
                ></b-form-input>
            </b-form-group>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class StringOrganism extends Vue {
    @Prop()
    loading: any;

    @Prop()
    form: any;

    get placeholderText() {
        let res = "";

        if (this.form.content.char_count > -1) {
            res = "Character limit " + this.form.content.char_count;
        }

        return res;
    }
}
</script>
