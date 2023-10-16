type MediaTest = {
    id: number;
    name: string;
    path: string;
};

type Data = {
    id: number;
    title: string;
    content: string;
    medias?: MediaTest[];
};
export interface DataSpy {
    data: Data[];
    error: boolean;
    fetchData: () => Promise<void>;
    isLoading: boolean;
}
