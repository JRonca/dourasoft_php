
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') },
      { path: '/clients', component: () => import('pages/Clients.vue') },
      { path: '/cadclients', component: () => import('pages/CadClients.vue') },
      { path: '/updateclients/:user', component: () => import('pages/UpdateClients.vue') },
      { path: '/products', component: () => import('pages/Products.vue') },
      { path: '/cadproducts', component: () => import('pages/CadProducts.vue') },
      { path: '/orders', component: () => import('pages/Orders.vue') },
      { path: '/cadorders', component: () => import('pages/CadOrders.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
