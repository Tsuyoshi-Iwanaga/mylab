import React, { useState } from 'react'
import styled from 'styled-components'
import { addMemo } from '../functions/client'

const TextArea = styled.textarea`
    min-height: 13em;
`

const MemoInput:React.FC = () => {

    const [category, setCategory] = useState(1)
    const [title, setTitle] = useState("")
    const [body, setBody] = useState("")

    const postMemo = ():void => {
        addMemo(category, title, body)
    }

    return (
        <div className="mb-3">
            <div className="form-group row">
                <label htmlFor="category_id" className="col-md-12 col-form-label text-md-left">カテゴリ</label>
                <div className="col-md-12 text-md-left">
                    <div className="custom-control custom-radio d-inline-block">
                        <input
                            type="radio"
                            name="category_id"
                            value="1"
                            className="custom-control-input"
                            id="radio-1"
                            onChange={ e => {setCategory(Number(e.target.value))}}
                            checked={ category === 1 }
                        />
                        <label className="custom-control-label" htmlFor="radio-1">その他</label>
                    </div>
                    <div className="custom-control custom-radio d-inline-block">
                        <input
                            type="radio"
                            name="category_id"
                            value="2"
                            className="custom-control-input"
                            id="radio-2"
                            onChange={ e => {setCategory(Number(e.target.value))}}
                            checked={ category === 2 }
                        />
                        <label className="custom-control-label" htmlFor="radio-2">キャリア</label>
                    </div>
                    <div className="custom-control custom-radio d-inline-block">
                        <input
                            type="radio"
                            name="category_id"
                            value="3"
                            className="custom-control-input"
                            id="radio-3"
                            onChange={ e => {setCategory(Number(e.target.value))}}
                            checked={ category === 3 }
                        />
                        <label className="custom-control-label" htmlFor="radio-3">家族</label>
                    </div>
                    <div className="custom-control custom-radio d-inline-block">
                        <input
                            type="radio"
                            name="category_id"
                            value="4"
                            className="custom-control-input"
                            id="radio-4"
                            onChange={ e => {setCategory(Number(e.target.value))}}
                            checked={ category === 4 }
                        />
                        <label className="custom-control-label" htmlFor="radio-4">プログラミング</label>
                    </div>
                </div>
            </div>
            <div className="form-group row">
                <label htmlFor="title" className="col-md-12 col-form-label text-md-left">タイトル</label>
                <div className="col-md-12">
                    <input
                        id="title"
                        type="title"
                        className="form-control"
                        name="title"
                        value={title}
                        required
                        autoComplete="title"
                        autoFocus
                        onChange={e => setTitle(e.target.value)}
                    />
                </div>
            </div>
            <div className="form-group row">
                <label htmlFor="body" className="col-md-12 col-form-label text-md-left">本文</label>
                <div className="col-md-12">
                    <TextArea id="body"
                        className="form-control"
                        name="body"
                        value={body}
                        required
                        autoComplete="body"
                        autoFocus
                        onChange={e => setBody(e.target.value)}
                    ></TextArea>
                </div>
            </div>
            <div className="form-group row mb-0">
                <div className="col-md-12 text-md-left">
                    <button className="btn btn-primary" onClick={postMemo}>メモを書き込む</button>
                </div>
            </div>
        </div>
    )
}
export default MemoInput