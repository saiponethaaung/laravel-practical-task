<template>
    <div>
        <b-form-group>
            <b-form-group
                :id="'text-' + form.content.id"
                :label="form.content.name"
                :label-for="'text-form-' + form.content.id"
            >
                <b-form-textarea
                    v-model="form.answer"
                    :id="'text-form-' + form.content.id"
                    type="text"
                    :placeholder="placeholderText"
                    :disabled="loading"
                    required
                ></b-form-textarea>
            </b-form-group>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class TextOrganism extends Vue {
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
