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
          v-model="name"
          name="name"
          label="Nome"
        />
        <q-input
          outlined
          name="phone"
          v-model="phone"
          label="Telefone"
        />
        <q-input outlined v-model="address" name="address" label="Endereço" />
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
  async data () {
    return {
      test: '',
      phone: '',
      name: `${this.$route.params.user.name}`,
      address: '',
      submitResult: {
        name: '',
        address: '',
        phone: ''
      },
      submitting: false
    }
  },
  methods: {
    async handleCreate (evt) {
      const formData = new FormData(evt.target)
      for (const [name, value] of formData.entries()) {
        if (name === 'name') {
          this.submitResult.name = value
        } else if (name === 'address') {
          this.submitResult.address = value
        } else {
          this.submitResult.phone = value
        }
      }
      await this.$axios.post('/api/clients/add', this.submitResult)
      this.$router.push('/clients')
    }
  }
}
</script>
