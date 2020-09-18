import fs from "fs"
import path from "path"
import hljs from 'highlight.js/lib/core';
import scss from 'highlight.js/lib/languages/scss';
import javascript from 'highlight.js/lib/languages/javascript';
import php from 'highlight.js/lib/languages/php';
import python from 'highlight.js/lib/languages/python';
import Layout from "../../components/Layout"
import { listContentFiles, readContentFile } from "../../lib/content-loader"
import React, { useState, useEffect } from 'react';

hljs.registerLanguage('scss', scss);
hljs.registerLanguage('js', javascript);
hljs.registerLanguage('php', php);
hljs.registerLanguage('py', python);

export default function Post(params) {
  useEffect(() => {
    hljs.initHighlighting();
    hljs.initHighlighting.called = false;
  })
  return (
    <Layout title={params.title}>
      <div className="post-meta">
        <span>{params.published}</span>
      </div>
      <div className="post-body"
        dangerouslySetInnerHTML={{ __html: params.content }}
      />
    </Layout>
  )
}

/**
 * ページコンポーネントで使用する値を用意する
 */
export async function getStaticProps({ params }) {
  const content = await readContentFile({ fs, slug: params.slug })

  return {
    props: {
      ...content
    }
  }
}

/**
 * 有効な URL パラメータを全件返す
 */
export async function getStaticPaths() {
  const paths = listContentFiles({ fs })
    .map((filename) => ({
      params: {
        slug: path.parse(filename).name,
      }
    }))

  return { paths, fallback: false }//パスに該当しない時は404を返す
}