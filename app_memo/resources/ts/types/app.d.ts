type TodoItem = {
    id: number,
    author_id?: string,
    status?: string,
    deadline?: string,
    planed_time?: string,
    actual_time?: string,
    body?: string,
    updated_at?: string,
    created_at?: string,
}

type MemoItem = {
    id: number,
    author_id?: number,
    category_id?: number,
    title?: string,
    body?: string,
    updated_at?: string,
    created_at?: string,
}