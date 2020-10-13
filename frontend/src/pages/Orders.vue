<template>
  <div class="q-pa-md">
    <q-btn to="/cadorders" color="primary" class="full-width" label="Adicionar" />

    <div v-show="!!selected.length" :props="selected">
      <q-btn-group id="vardelete" spread>
        <q-btn color="primary" label="Editar" icon="edit" @click="handleUpdate(selected[0].id)" />
        <q-btn color="primary" label="Deletar" icon="delete" @click="handleDelete(selected[0].id)" />
      </q-btn-group>
    </div>
    <q-table
      title="Pedidos"
      :data="data"
      :columns="columns"
      row-key="id"
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
        {
          name: 'id',
          align: 'center',
          label: 'ID',
          field: 'id',
          sortable: true
        },
        { name: 'client_id', label: 'ID Cliente', field: 'client_id' },
        { name: 'total', label: 'Total', field: 'total' },
        {
          name: 'date_order',
          label: 'Data',
          sortable: true,
          field: 'date_order'
        },
        {
          name: 'status',
          required: true,
          label: 'Status',
          sortable: true,
          field: 'status'
        }
      ],
      data: [
        this.$axios.get('/api/orders')
          .then((response) => {
            this.data = response.data
          })
      ]
    }
  },
  methods: {
    async handleDelete (id) {
      await this.$axios.delete(`/api/orders/delete/${id}`)
    },
    async handleUpdate (id) {
      const user = await this.$axios.delete(`/api/orders/view/${id}`)
      this.$router.push(`/updateproducts/${user}`)
    }
  }
}
</script>
