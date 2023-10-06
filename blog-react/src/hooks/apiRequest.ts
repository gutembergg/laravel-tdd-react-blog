import axios from 'axios';
import { useState } from 'react';

type Options = {
    search?: string;
    direction?: string;
};

export const useApiRequests = <T = any>(path: string, options?: Options) => {
    console.log(path, options);

    const [data, setData] = useState<T[] | null | any>(null);
    const [error, setError] = useState(false);

    const fetchData = async () => {
        try {
            const response = await axios.get<T[]>(path, {
                params: options,
            });

            setData(response);
        } catch (error) {
            setError(true);
        }
    };

    return { data, error, fetchData };
};
