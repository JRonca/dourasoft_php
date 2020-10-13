<style>
.flex-class{
  display: flex;
  place-content: center;
  flex-direction: column;
}
.div-flex-class{
  display: flex;
  align-self: center;
  place-content: center;
  flex-direction: column;
  width: 30%;
}
.title{
  align-self: center;
}
</style>
<template>
  <div class="q-pa-md">
    <div class="flex-class">
      <h4 class="title">Cadastro de clientes</h4>
      <q-form @submit="handleCreate" class="q-gutter-md div-flex-class">
        <q-input
          outlined
          v-model="client_id"
          name="client_id"
          label="ID Cliente"
        />
        <q-input
          outlined
          name="status"
          v-model="status"
          label="Status"
        />
        <q-input outlined v-model="date_order" type="date" name="date_order" />
        <q-btn
          type="submit"
          :loading="submitting"
          label="Cadastrar"
          class="q-mt-md"
          color="primary"
        >
          <template v-slot:loading>
            <q-spinner-facebook />
          </template>
        </q-btn>
      </q-form>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      test: '',
      status: '',
      client_id: '',
      date_order: '',
      submitResult: {
        client_id: '',
        date_order: '',
        status: ''
      },
      submitting: false
    }
  },
  methods: {
    async handleCreate (evt) {
      const formData = new FormData(evt.target)
      for (const [name, value] of formData.entries()) {
        if (name === 'client_id') {
          this.submitResult.client_id = value
        } else if (name === 'date_order') {
          this.submitResult.date_order = value
        } else {
          this.submitResult.status = value
        }
        this.submitResult.total = 0
      }
      await this.$axios.post('/api/orders/add', this.submitResult)
      this.$router.push('/orders')
    }
  }
}
</script>
