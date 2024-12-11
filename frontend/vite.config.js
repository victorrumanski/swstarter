import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import sass from "sass";

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  css: {
    preprocessorOptions: {
      scss: {
        implementation: sass,
      },
    },
  },
  server: {
    host: true, // This allows Vite to accept connections from outside the container
    port: 5173, // The port Vite will run on
    strictPort: true, // If the port is already used, Vite will fail instead of picking another port
    watch: {
      usePolling: true, // This is needed to work well inside Docker
    },
  },
});
