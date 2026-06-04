<template>
  <div class="p-8 max-w-xl mx-auto bg-white dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-lg text-neutral-900 dark:text-white mt-10 transition-colors duration-200">
    
    <h1 class="text-2xl font-bold mb-6 text-neutral-800 dark:text-neutral-100 flex items-center gap-2">
      <span>📚</span> Registrar Nuevo Libro
    </h1>
    
    <form @submit.prevent="enviar" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Título:</label>
        <input v-model="form.titulo" type="text" class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700 rounded-lg p-2.5 text-neutral-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required />
      </div>

      <div>
        <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Autor:</label>
        <input v-model="form.autor" type="text" class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700 rounded-lg p-2.5 text-neutral-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required />
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Año:</label>
          <input v-model="form.anio" type="number" class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700 rounded-lg p-2.5 text-neutral-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required />
        </div>

        <div>
          <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Categoría:</label>
          <select v-model="form.categoria_id" class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700 rounded-lg p-2.5 text-neutral-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required>
            <option value="" disabled class="text-neutral-400 dark:text-neutral-500">Selecciona una</option>
            <option v-for="cat in categorias" :key="cat.id" :value="cat.id" class="bg-white dark:bg-neutral-900 text-neutral-900 dark:text-white">
              {{ cat.nombre }}
            </option>
          </select>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Portada (Imagen):</label>
        <input type="file" @input="form.portada = $event.target.files[0]" class="w-full text-sm text-neutral-500 dark:text-neutral-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-neutral-100 dark:file:bg-neutral-800 file:text-neutral-700 dark:file:text-neutral-200 hover:file:bg-neutral-200 dark:hover:file:bg-neutral-700 file:cursor-pointer" />
      </div>

      <div class="pt-2">
        <button type="submit" class="w-full bg-emerald-600 text-white font-semibold p-3 rounded-lg hover:bg-emerald-500 transition-all shadow-md shadow-emerald-900/20">
          Guardar Libro
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

defineProps({ categorias: Array });

const form = useForm({
  titulo: '',
  autor: '',
  anio: '',
  categoria_id: '',
  portada: null,
});

const enviar = () => {
  form.post('/libros');
};
</script>