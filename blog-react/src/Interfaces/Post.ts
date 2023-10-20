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
    author: string;
    categories?: Category[];
    medias: Media[] | null;
    created_at?: string;
}
