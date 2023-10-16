type Category = {
    id: number;
    name: string;
};

export type Media = {
    id: number;
    name: string;
    path: string;
};

export interface Post {
    id: number;
    title: string;
    content: string;
    slug: string;
    categories?: Category[];
    medias?: Media[];
}
