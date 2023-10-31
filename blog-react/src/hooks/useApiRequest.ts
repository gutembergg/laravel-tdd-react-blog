import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

export const useApiRequests = <T = any>(path: string, options?: any, paginated = false) => {
    const [data, setData] = useState<T | null>(null);
    const [error, setError] = useState(false);
    const [isLoading, setIsLoading] = useState(true);

    const fetchData = useCallback(async () => {
        try {
            const { data: response } = await axios.get(path, {
                params: options,
            });

            setData(paginated ? response : response.data);
        } catch (error) {
            setError(true);
        } finally {
            setIsLoading(false);
        }
    }, [options, path, paginated]);

    useEffect(() => {
        fetchData();
    }, [options]);

    return { data, error, fetchData, isLoading };
};
