<template>
  <div>
    <pre class="code">{{ htmlText }}</pre>
    <pre class="code">{{ cssText }}</pre>
    <pre class="code">{{ jsText }}</pre>
    <input
      type="text"
      v-model="htmlRaw"
      cols="30"
      rows="5"
      style="width:100%"
    />
    <input type="text" v-model="cssRaw" cols="30" rows="5" style="width:100%" />
    <input type="text" v-model="jsRaw" cols="30" rows="5" style="width:100%" />
    <div id="htmlCode">
      <images></images>
      <heading></heading>
    </div>
  </div>
</template>

<script>
import beautify from "js-beautify";

const option = {
  indent_size: 2,
  indent_char: " ",
  indent_with_tabs: false,
  editorconfig: false,
  eol: "\n",
  end_with_newline: false,
  indent_level: 0,
  preserve_newlines: true,
  max_preserve_newlines: 10,
  space_in_paren: false,
  space_in_empty_paren: false,
  jslint_happy: false,
  space_after_anon_function: false,
  space_after_named_function: false,
  brace_style: "collapse",
  unindent_chained_methods: false,
  break_chained_methods: false,
  keep_array_indentation: false,
  unescape_strings: false,
  wrap_line_length: 0,
  e4x: false,
  comma_first: false,
  operator_position: "before-newline",
  indent_empty_lines: false,
  templating: ["auto"]
};

export default {
  name: "Top",
  components: {},
  data() {
    return {
      htmlRaw: "<div><p>aaa</p></div>",
      cssRaw: ".hoge{background:#fff;font-size:2.4rem;}",
      jsRaw:
        'console.log("aaa");console.log("bbb");if(true){console.log("aaaa")}'
    };
  },
  computed: {
    htmlText() {
      return beautify.html(this.htmlRaw, option);
    },
    cssText() {
      return beautify.css(this.cssRaw, option);
    },
    jsText() {
      return beautify.js(this.jsRaw, option);
    }
  }
};
</script>

<style lang="scss">
.code {
  background: #282c34;
  color: #abb2bf;
  padding: 0.5em;
}
.panel {
  border-radius: 10px;
  background: #eee;
  padding: 20px;
}
</style>
