<template>
  <div class="q-pa-md">
    <q-btn to="/cadproducts" color="primary" class="full-width" label="Adicionar" />

    <div v-show="!!selected.length" :props="selected">
      <q-btn-group id="vardelete" spread>
        <q-btn color="primary" label="Editar" icon="edit" @click="handleUpdate(selected[0].code)" />
        <q-btn color="primary" label="Deletar" icon="delete" @click="handleDelete(selected[0].code)" />
      </q-btn-group>
    </div>
    <q-table
      title="Produtos"
      :data="data"
      :columns="columns"
      row-key="code"
      selection="single"
      :selected.sync="selected"
    />
  </div>
</template>
<script>
export default {
  data () {
    return {
      selected: [],
      columns: [
        { name: 'code', label: 'Código', field: 'code', align: 'center', sortable: true },
        {
          name: 'name',
          required: true,
          label: 'Nome',
          align: 'left',
          field: row => row.name,
          format: val => `${val}`,
          sortable: true
        },
        { name: 'description', label: 'Descrição', field: 'description' },
        { name: 'price', label: 'Preço', field: 'price' }
      ],
      data: [
        this.$axios.get('/api/products')
          .then((response) => {
            this.data = response.data
          })
      ]
    }
  },
  methods: {
    async handleDelete (code) {
      await this.$axios.delete(`/api/products/delete/${code}`)
    },
    async handleUpdate (code) {
      const user = await this.$axios.delete(`/api/products/view/${code}`)
      this.$router.push(`/updateproducts/${user}`)
    }
  }
}
</script>
