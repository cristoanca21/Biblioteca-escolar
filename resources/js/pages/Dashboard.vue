<template>
  <div class="p-6 max-w-7xl mx-auto transition-colors duration-200">
    <div class="mb-8">
      <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 tracking-tight">¡Bienvenido a la Biblioteca Escolar!</h1>
      <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-0.5">Control de inventario y analíticas de la Biblioteca Escolar.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      
      <div class="p-6 bg-white dark:bg-neutral-900/50 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-sm flex items-center gap-5">
        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-950/40 rounded-lg flex items-center justify-center text-2xl border border-emerald-100 dark:border-emerald-900/50">
          📚
        </div>
        <div>
          <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total de Libros</p>
          <p class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mt-0.5">{{ totalLibros }}</p>
        </div>
      </div>

      <div class="p-6 bg-white dark:bg-neutral-900/50 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-sm flex items-center gap-5">
        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-950/40 rounded-lg flex items-center justify-center text-2xl border border-blue-100 dark:border-blue-900/50">
          🗂️
        </div>
        <div>
          <p class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Categorías Activas</p>
          <p class="text-3xl font-bold text-neutral-900 dark:text-neutral-100 mt-0.5">{{ totalCategorias }}</p>
        </div>
      </div>

      <div class="p-6 bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-xl shadow-sm flex flex-col justify-between">
        <p class="text-sm font-medium text-neutral-700 dark:text-neutral-300">Accesos Directos</p>
        <div class="flex gap-2 mt-4">
          <a href="/libros/create" class="flex-1 inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold px-3 py-2 rounded-lg transition-colors text-center">
            + Libro
          </a>
          <a href="/categorias/create" class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold px-3 py-2 rounded-lg transition-colors text-center">
            + Categoría
          </a>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
defineProps({
  totalLibros: Number,
  totalCategorias: Number
});
</script>