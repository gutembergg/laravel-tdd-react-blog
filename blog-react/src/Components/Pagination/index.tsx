import { PaginationMeta } from '../../Interfaces/Post';
import { usePaginate } from '../../hooks/usePaginate';

interface PaginationProps {
    meta: PaginationMeta;
    currentPage: number;
    handleCurrentPage: (page: number) => void;
}

function Pagination({ meta, currentPage, handleCurrentPage }: PaginationProps) {
    const { pages } = usePaginate({
        currentPage: currentPage,
        totalItems: meta.total,
        perPage: meta.per_page,
        maxBtnVisible: 3,
    });

    return (
        <div className="flex w-full justify-center p-6 space-x-2">
            {pages?.map((page) => {
                return (
                    <button
                        className={`dark:bg-slate-600 px-2 py-1 text-white ${page.isDisabled && 'dark:bg-slate-800'}`}
                        key={page.name}
                        onClick={() => handleCurrentPage(page.name)}
                        disabled={page.isDisabled}
                    >
                        {page.name}
                    </button>
                );
            })}
        </div>
    );
}

export default Pagination;
