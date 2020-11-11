import React from 'react'

type MemoItem = {
    id: number,
    author_id?: number,
    category_id?: number,
    title?: string,
    body?: string,
    updated_at?: string,
    created_at?: string,
}

type MemoItemProps = {
    item: MemoItem
}

const convertCategoryName = (id: number|undefined) => {
    if (!id) return ""

    switch (id) {
        case 1:
            return "その他"; break;
        case 2:
            return "キャリア"; break;
        case 3:
            return "家族"; break;
        case 4:
            return "家族"; break;
        default:
            return ""; break;
    }
}

const MemoItem:React.FC<MemoItemProps> = (props) => {
    return (
        <div className="card mb-3">
            <div className="card-header">
                {props.item.title} / 
                {convertCategoryName(props.item.category_id)} / 
                {props.item.author_id} / 
                {props.item.created_at}
            </div>
            <div className="card-body">
                {props.item.body ? props.item.body.split('\n').map((v, i) => (
                    <React.Fragment key={i}>{v}<br /></React.Fragment>
                )): ""}
            </div>
        </div>
    )
}
export default MemoItem