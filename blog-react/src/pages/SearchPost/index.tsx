import { ChangeEvent, useState } from 'react';
import { BsSearch } from 'react-icons/bs';
import { useApiRequests } from '../../hooks/useApiRequest';
import DefaultLayout from '../../layouts/DefaultLayout';
import { Post } from '../../Interfaces/Post';
import Input from '../../Components/Form/Input';

type Options = {
    search?: string;
    direction?: string;
};

function SearchPost() {
    const [options, setOptions] = useState<Options>({} as Options);
    const { data, error, isLoading } = useApiRequests(`http://localhost/api/posts/search`, options);

    function handleChangeOptions(e: ChangeEvent<HTMLInputElement>) {
        setOptions({
            ...options,
            [e.target.name]: e.target.value,
        });
    }
    console.log('Api', options, error, isLoading);

    return (
        <DefaultLayout>
            <Input name="search" onChange={(e) => handleChangeOptions(e)} icon={BsSearch} placeholder="Search" />
            <div>
                {data &&
                    data.map((post: Post) => {
                        return <li key={post.id}>{post.title}</li>;
                    })}
            </div>
        </DefaultLayout>
    );
}

export default SearchPost;
