import React from 'react'
import MemoItem from './MemoItem'

type MemoListProps = {
    items: Array<MemoItem>
}

const MemoList:React.FC<MemoListProps> = (props) => {
    return (
        <div>
            {props.items.map((v) => <MemoItem item={v} key={v.id} />)}
        </div>
    )
}
export default MemoList