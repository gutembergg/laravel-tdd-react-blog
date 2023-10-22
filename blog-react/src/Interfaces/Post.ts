type Category = {
    id: number;
    name: string;
};

export type Media = {
    id: number;
    name: string;
    path: string;
};

type Author = {
    id: number;
    name: string;
};

export interface Post {
    id: number;
    title: string;
    content: string;
    slug: string;
    author: Author;
    categories?: Category[];
    medias: Media[] | null;
    created_at?: string;
}

export interface ApiData {
    data: Post[] | null;
}
