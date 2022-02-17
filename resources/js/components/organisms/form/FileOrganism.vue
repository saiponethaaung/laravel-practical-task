<template>
    <div>
        <b-form-group>
            <b-form-group
                :id="'file-' + form.content.id"
                :label="form.content.name"
                :label-for="'file-form-' + form.content.id"
            >
                <b-form-file
                    v-model="form.answer"
                    :id="'file-form-' + form.content.id"
                    type="text"
                    :placeholder="placeholderText"
                    :disabled="loading"
                    :accept="form.content.values"
                    required
                ></b-form-file>
            </b-form-group>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class FileOrganism extends Vue {
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
