import { resolve } from 'path'
import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'

import postcsspxtoviewport from 'postcss-px-to-viewport'

import viteImagemin from '@vheemstra/vite-plugin-imagemin'

// The minifiers you want to use:
import imageminMozjpeg from 'imagemin-mozjpeg'
import imageminPngquant from 'imagemin-pngquant'
import imageminWebp from 'imagemin-webp'

import { visualizer } from 'rollup-plugin-visualizer'

// https://vitejs.dev/config/
export default defineConfig(({ mode }) => {
  const ENV = loadEnv(mode, process.cwd())
  return {
    esbuild: {
      drop: ['console', 'debugger'], // 删除
    },
    base: './',
    resolve: {
      alias: {
        '@': resolve(__dirname, './src'),
      },
    },
    server: {
      host: '0.0.0.0',
      proxy: {
        '/app': {
          target: ENV.VITE_APP_BASEAPI_PROXY_TARGET,
          changeOrigin: true,
          // secure: false
        },
      },
    },
    build: {
      assetsInlineLimit: '204800',
    },
    plugins: [
      vue(),
      visualizer({
        gzipSize: true,
        emitFile: true,
        filename: 'stats.html',
      }),
      viteImagemin({
        plugins: {
          jpg: imageminMozjpeg(),
          png: imageminPngquant(),
        },
        ...(ENV.VITE_MINIFIER_WEBP && {
          makeWebp: {
            plugins: {
              png: imageminWebp(),
            },
          },
        }),
      }),
    ],
    css: {
      postcss: {
        plugins: [
          // ENV.VITE_PXTOCSS &&
          //   postcsspxtoviewport({
          //     // unitToConvert: 'px',
          //     // viewportWidth: 375, // UI Design Width
          //     // unitPrecision: 6,
          //     // propList: ['*', '!max-*'], // can change
          //     // viewportUnit: 'ds%', // Expected units.
          //     // fontViewportUnit: 'vw', // Expected units for font.
          //     // selectorBlackList: ['ignore-', ':root'], // The selectors to ignore and leave as px
          //     // minPixelValue: 1,
          //     // mediaQuery: false,
          //     // replace: true,
          //     // // exclude: [/node_modules/],
          //     // exclude: [],
          //     // landscape: false, //
          //   }),
        ],
      },
    },
  }
})
