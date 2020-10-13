<template>
  <div class="q-pa-md">
    <q-btn to="/cadclients" color="primary" class="full-width" label="Adicionar" />

    <div v-show="!!selected.length" :props="selected">
      <q-btn-group id="vardelete" spread>
        <q-btn color="primary" label="Editar" icon="edit" @click="handleUpdate(selected[0].id)" />
        <q-btn color="primary" label="Deletar" icon="delete" @click="handleDelete(selected[0].id)" />
      </q-btn-group>
    </div>
    <q-table
      title="Clientes"
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
        {
          name: 'name',
          required: true,
          label: 'Nome',
          align: 'left',
          field: row => row.name,
          format: val => `${val}`,
          sortable: true
        },
        { name: 'address', label: 'Endereço', field: 'address' },
        { name: 'phone', label: 'Telefone', field: 'phone' }
      ],
      data: [
        this.$axios.get('/api/clients')
          .then((response) => {
            this.data = response.data
          })
      ]
    }
  },
  methods: {
    async handleDelete (id) {
      await this.$axios.delete(`/api/clients/delete/${id}`)
    },
    async handleUpdate (id) {
      const user = await this.$axios.delete(`/api/clients/view/${id}`)
      this.$router.push(`/updateclients/${user}`)
    }
  }
}
</script>
