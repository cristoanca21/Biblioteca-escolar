<template>
  <div class="p-6 max-w-7xl mx-auto mt-4 transition-colors duration-200">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 tracking-tight">🗂️ Categorías de Libros</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">Clasifica la biblioteca escolar para facilitar la búsqueda.</p>
      </div>
      <a href="/categorias/create" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow-sm shadow-blue-900/10 transition-all">
        Nueva Categoría
      </a>
    </div>

    <div class="overflow-hidden bg-white dark:bg-neutral-900/50 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-sm">
      <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] border-collapse text-left text-sm">
          <thead>
            <tr class="border-b border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 font-semibold">
              <th scope="col" class="px-6 py-4 w-20">ID</th>
              <th scope="col" class="px-6 py-4 w-1/3">Nombre de la Categoría</th>
              <th scope="col" class="px-6 py-4">Descripción</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800 text-neutral-700 dark:text-neutral-300">
            <tr v-for="cat in categorias" :key="cat.id" class="hover:bg-neutral-50/70 dark:hover:bg-neutral-900/30 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-neutral-400 dark:text-neutral-500">
                #{{ cat.id }}
              </td>
              <td class="px-6 py-4 font-semibold text-neutral-900 dark:text-neutral-100">
                {{ cat.nombre }}
              </td>
              <td class="px-6 py-4 text-neutral-500 dark:text-neutral-400 max-w-md truncate">
                {{ cat.descripcion || 'Sin descripción asignada' }}
              </td>
            </tr>
            <tr v-if="categorias.length === 0">
              <td colspan="3" class="px-6 py-12 text-center text-neutral-400 dark:text-neutral-500">
                <span class="block text-2xl mb-1">📂</span> No hay categorías creadas aún.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({ categorias: Array });
</script>