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
      <h4 class="title">Cadastro de Produtos</h4>
      <q-form @submit="handleCreate" class="q-gutter-md div-flex-class">
        <q-input
          outlined
          v-model="code"
          name="code"
          label="Código"
        />
        <q-input
          outlined
          v-model="name"
          name="name"
          label="Nome"
        />
        <q-input
          outlined
          name="description"
          v-model="description"
          label="Descrição"
        />
        <q-input outlined v-model="price" name="price" label="Preço" />
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
      description: '',
      code: '',
      name: '',
      price: '',
      submitResult: {
        name: '',
        price: '',
        description: ''
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
        } else if (name === 'price') {
          this.submitResult.price = value
        } else if (name === 'description') {
          this.submitResult.description = value
        } else {
          this.submitResult.code = value
        }
      }
      await this.$axios.post('/api/products/add', this.submitResult)
      this.$router.push('/products')
    }
  }
}
</script>
