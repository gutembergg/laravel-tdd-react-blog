import { useEffect, useState } from 'react';

interface PaginateProps {
    currentPage?: number;
    totalItems?: number;
    perPage: number;
    maxBtnVisible: number;
}

export type RagePages = {
    name: number;
    isDisabled: boolean;
};

export function usePaginate({ currentPage = 1, totalItems = 0, perPage, maxBtnVisible = 3 }: PaginateProps) {
    const [pages, setPages] = useState<RagePages[]>([]);

    const totalPages = Math.ceil(totalItems / perPage);

    function getListPages() {
        const range = [];
        for (let i = startPage(); i <= Math.min(startPage() + maxBtnVisible - 1, totalPages); i++) {
            range.push({ name: i, isDisabled: i === currentPage });
        }
        setPages(range);
    }

    function startPage() {
        const listSize = totalPages < 3 ? 2 : 3;

        if (currentPage === 1) {
            return 1;
        }

        if (totalPages === currentPage) {
            return totalPages - listSize + 1;
        }

        return currentPage - 1;
    }

    useEffect(() => {
        getListPages();
    }, [currentPage, totalItems]);

    return {
        pages,
        getListPages,
    };
}
