import { ChangeEvent, useState } from 'react';
import { BsSearch } from 'react-icons/bs';
import { useApiRequests } from '../../hooks/useApiRequest';
import DefaultLayout from '../../layouts/DefaultLayout';
import { Post } from '../../Interfaces/Post';
import Input from '../../Components/Form/Input';
import { Card } from '../../Components/Posts/Card';
import PostsList from '../../Components/Posts/PostsList/PostsList';

type Options = {
    search?: string;
    direction?: string;
};

function SearchPost() {
    const [options, setOptions] = useState<Options>({} as Options);
    const { data, error, isLoading, fetchData } = useApiRequests(`http://localhost/api/posts/search`, options, true);

    function handleChangeOptions(e: ChangeEvent<HTMLInputElement>) {
        setOptions({
            ...options,
            [e.target.name]: e.target.value,
        });
    }
    console.log('Api', data, error, isLoading);

    return (
        <DefaultLayout>
            <Input name="search" onChange={(e) => handleChangeOptions(e)} icon={BsSearch} placeholder="Search" />
            <button onClick={fetchData}>Serach</button>
            <div>
                <PostsList data={data.data} error={error} isLoading={isLoading} />
                {/*     {data &&
                    data.data.map((post: Post) => {
                        return (
                            <Card.root key={post.id}>
                                <Card.content post={post} />
                            </Card.root>
                        );
                    })} */}
            </div>
        </DefaultLayout>
    );
}

export default SearchPost;
