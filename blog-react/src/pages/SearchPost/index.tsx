import { ChangeEvent, useState } from 'react';
import { BsSearch } from 'react-icons/bs';
import { useApiRequests } from '../../hooks/useApiRequest';
import DefaultLayout from '../../layouts/DefaultLayout';
import Input from '../../Components/Form/Input';
import PostsList from '../../Components/Posts/PostsList/PostsList';
import Button from '../../Components/Form/Button';
import Pagination from '../../Components/Pagination';
import Error from '../../Components/Utils/Error';
import Loading from '../../Components/Utils/Loading';

type Options = {
    search?: string;
    direction?: string;
    page: number;
};

function SearchPost() {
    const [options, setOptions] = useState<Options>({ search: '', direction: 'desc', page: 1 });
    const { data, error, isLoading, fetchData } = useApiRequests(`http://localhost/api/posts/search/`, options, true);

    function handleChangeOptions(e: ChangeEvent<HTMLInputElement>) {
        setOptions({
            ...options,
            [e.target.name]: e.target.value,
        });
    }

    function handleCurrentPage(page: number): void {
        setOptions({
            ...options,
            page,
        });
    }

    return (
        <DefaultLayout>
            <div className="min:h-[100vh] bg-inherit">
                <div className="flex md:max-w-[50%] mx-auto space-x-2 pt-16 pb-16">
                    <Input name="search" onChange={(e) => handleChangeOptions(e)} icon={BsSearch} placeholder="Search" />
                    <Button
                        className="p-4 h-fit hover:dark:bg-slate-400 hover:dark:border-slate-400 hover:text-black dark:border dark:border-white text-black dark:text-white"
                        onClick={fetchData}
                    >
                        Search
                    </Button>
                </div>
                <div className=" w-[90%] mx-auto">{data && <PostsList data={data.data} />}</div>

                {error && <Error />}
                {isLoading && <Loading />}

                {data && <Pagination meta={data.meta} currentPage={options.page} handleCurrentPage={handleCurrentPage} />}
            </div>
        </DefaultLayout>
    );
}

export default SearchPost;
