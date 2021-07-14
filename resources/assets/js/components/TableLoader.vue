<template>
  <div>
    <content-loader
      viewBox="0 0 476 124"
      primaryColor="#f3f3f3"
      secondaryColor="#cccccc"
    >
      <rect x="0" y="0" rx="3" ry="3" width="370" height="6" />
      <rect x="0" y="16" rx="3" ry="3" width="320" height="6" />
      <rect x="0" y="32" rx="3" ry="3" width="270" height="6" />

      <rect x="0" y="64" rx="3" ry="3" width="370" height="6" />
      <rect x="0" y="80" rx="3" ry="3" width="320" height="6" />
      <rect x="0" y="96" rx="3" ry="3" width="270" height="6" />

      <rect x="0" y="128" rx="3" ry="3" width="370" height="6" />
      <rect x="0" y="144" rx="3" ry="3" width="320" height="6" />
      <rect x="0" y="160" rx="3" ry="3" width="270" height="6" />

      <rect x="0" y="192" rx="3" ry="3" width="370" height="6" />
      <rect x="0" y="208" rx="3" ry="3" width="320" height="6" />
      <rect x="0" y="224" rx="3" ry="3" width="270" height="6" />
    </content-loader>
  </div>
</template>

<script>
import { ContentLoader } from "vue-content-loader";

export default {
  name: "TableLoader",
  components: {
    ContentLoader,
  },
};
</script>

<style>
#TableLoader {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  padding: 2rem;
}
</style>