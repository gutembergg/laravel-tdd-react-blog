import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

type Options = {
    search?: string;
    direction?: string;
};

export const useApiRequests = <T = any>(path: string, options?: Options) => {
    const [data, setData] = useState<T | null>(null);
    const [error, setError] = useState(false);
    const [isLoading, setIsLoading] = useState(true);

    const fetchData = useCallback(async () => {
        try {
            const { data: response } = await axios.get(path, {
                params: options,
            });

            setData(response.data);
        } catch (error) {
            setError(true);
        } finally {
            setIsLoading(false);
        }
    }, [options, path]);

    useEffect(() => {
        fetchData();
    }, []);

    return { data, error, fetchData, isLoading };
};
