<template>
  <div>
    <Head title="Contact Form" />

    <Heading class="mb-6">Contact Us</Heading>

    <Card class="max-w-2xl mx-auto p-6 shadow-lg">
      <!-- Formulario de contacto -->
      <form @submit.prevent="submitForm" class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
          <input 
            v-model="form.name"
            type="text" 
            id="name" 
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-700 dark:focus:ring-indigo-500"
          />
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
          <input 
            v-model="form.email"
            type="email" 
            id="email" 
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-700 dark:focus:ring-indigo-500"
          />
        </div>

        <div>
          <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
          <textarea 
            v-model="form.message"
            id="message" 
            rows="4" 
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-white dark:border-gray-700 dark:focus:ring-indigo-500"
          ></textarea>
        </div>

        <div>
          <button 
            type="submit" 
            class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50"
          >
            Submit
          </button>
        </div>
      </form>

      <!-- Mensaje de confirmación después de enviar el formulario -->
      <div v-if="formSubmitted" class="mt-6 text-center text-lg text-green-600">
        <p>Your message has been sent successfully!</p>
      </div>
    </Card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        message: ''
      },
      formSubmitted: false
    }
  },
  methods: {
    submitForm() {
      // Simulamos el envío del formulario (puedes conectar esto a una API)
      this.formSubmitted = true;

      // Limpiar el formulario después de enviarlo
      setTimeout(() => {
        this.form.name = '';
        this.form.email = '';
        this.form.message = '';
        this.formSubmitted = false;
      }, 3000);
    }
  }
}
</script>

<style scoped>
/* Agrega estilos personalizados si es necesario */
</style>
