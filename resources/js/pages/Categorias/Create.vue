<template>
  <div class="p-8 max-w-xl mx-auto bg-white dark:bg-neutral-950 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-lg text-neutral-900 dark:text-white mt-10 transition-colors duration-200">
    
    <h1 class="text-2xl font-bold mb-6 text-neutral-800 dark:text-neutral-100 flex items-center gap-2">
      <span>🗂️</span> Crear Nueva Categoría
    </h1>
    
    <form @submit.prevent="enviar" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Nombre de la Categoría:</label>
        <input 
          v-model="form.nombre" 
          type="text" 
          placeholder="Ej. Literatura, Ciencia, Historia..."
          class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700 rounded-lg p-2.5 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none placeholder-neutral-400 dark:placeholder-neutral-600" 
          required 
        />
      </div>

      <div>
        <label class="block text-sm font-medium text-neutral-600 dark:text-neutral-300 mb-1">Descripción (Opcional):</label>
        <textarea 
          v-model="form.descripcion" 
          rows="4"
          placeholder="Escribe una breve descripción sobre los libros que abarcará esta categoría..."
          class="w-full bg-neutral-50 dark:bg-neutral-900 border border-neutral-300 dark:border-neutral-700 rounded-lg p-2.5 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none resize-none placeholder-neutral-400 dark:placeholder-neutral-600"
        ></textarea>
      </div>

      <div class="pt-2">
        <button 
          type="submit" 
          class="w-full bg-blue-600 text-white font-semibold p-3 rounded-lg hover:bg-blue-500 transition-all shadow-md shadow-blue-900/20"
        >
          Guardar Categoría
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  nombre: '',
  descripcion: '',
});

const enviar = () => {
  form.post('/categorias');
};
</script>