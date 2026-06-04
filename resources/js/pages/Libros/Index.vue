<template>
  <div class="p-6 max-w-7xl mx-auto mt-4 transition-colors duration-200">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 tracking-tight">📚 Biblioteca Escolar</h1>
        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">Gestiona el inventario de libros disponibles y sus categorías.</p>
      </div>
      <a href="/libros/create" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow-sm shadow-emerald-900/10 transition-all">
        Añadir Libro
      </a>
    </div>

    <div class="overflow-hidden bg-white dark:bg-neutral-900/50 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-sm">
      <div class="overflow-x-auto">
        <table class="w-full min-w-[800px] border-collapse text-left text-sm">
          <thead>
            <tr class="border-b border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 text-neutral-600 dark:text-neutral-400 font-semibold">
              <th scope="col" class="px-6 py-4 w-24">Portada</th>
              <th scope="col" class="px-6 py-4">Título</th>
              <th scope="col" class="px-6 py-4">Autor</th>
              <th scope="col" class="px-6 py-4 w-24">Año</th>
              <th scope="col" class="px-6 py-4">Categoría</th>
              <th scope="col" class="px-6 py-4 text-right w-32">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800 text-neutral-700 dark:text-neutral-300">
            <tr v-for="libro in libros" :key="libro.id" class="hover:bg-neutral-50/70 dark:hover:bg-neutral-900/30 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <img v-if="libro.portada" :src="libro.portada" alt="Portada" class="w-12 h-16 object-cover rounded-md shadow-sm border border-neutral-200 dark:border-neutral-700" />
                  <div v-else class="w-12 h-16 bg-neutral-100 dark:bg-neutral-800 rounded-md flex items-center justify-center text-neutral-400 dark:text-neutral-500 border border-dashed border-neutral-300 dark:border-neutral-700 text-xs">
                    No foto
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 font-medium text-neutral-900 dark:text-neutral-100 max-w-xs truncate">
                {{ libro.titulo }}
              </td>
              <td class="px-6 py-4 text-neutral-500 dark:text-neutral-400 max-w-[160px] truncate">
                {{ libro.autor }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-800 dark:text-neutral-200">
                  {{ libro.anio }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 border border-blue-100 dark:border-blue-900/50">
                  {{ libro.categoria?.nombre || 'Sin categoría' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                <a :href="`/libros/${libro.id}/edit`" class="text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 transition-colors font-semibold">
                  Editar
                </a>
                <button @click="eliminar(libro.id)" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300 transition-colors font-semibold">
                  Eliminar
                </button>
              </td>
            </tr>
            <tr v-if="libros.length === 0">
              <td colspan="6" class="px-6 py-12 text-center text-neutral-400 dark:text-neutral-500">
                <span class="block text-2xl mb-1">📭</span> No hay libros registrados actualmente.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

defineProps({ libros: Array });

const eliminar = (id) => {
  if (confirm('¿Seguro que deseas eliminar este libro?')) {
    router.delete(`/libros/${id}`);
  }
};
</script>