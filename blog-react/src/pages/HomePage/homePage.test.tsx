import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect } from 'vitest';
import HomePage from '.';
import { BrowserRouter } from 'react-router-dom';
import LastPosts from '../../Components/Posts/LastPosts';

describe('HomePage', () => {
    test('HomePage header link exist', () => {
        const { getAllByText } = render(
            <BrowserRouter>
                <HomePage />
            </BrowserRouter>
        );

        const headerLink = getAllByText(/Parcourir tout les articles/i);

        expect(headerLink).toHaveLength(1);
    });

    test('LastPostsComponents should display last 8 posts', async () => {
        const { findAllByRole } = render(
            <BrowserRouter>
                <LastPosts data={[{ id: 1, title: 'test', description: 'desc' }]} error={false} isLoading={false} />
            </BrowserRouter>
        );

        const listItems = await findAllByRole('listitem');

        expect(listItems).toHaveLength(1);
    });

    test('LastPostsComponents should display Loading... before api call resolve', async () => {
        const { findAllByRole, getByText } = render(
            <BrowserRouter>
                <LastPosts data={[{ id: 1, title: 'test', description: 'desc' }]} error={false} isLoading={true} />
            </BrowserRouter>
        );

        const loading = getByText(/Loading.../i);

        expect(loading).toBeInTheDocument();

        const listItems = await findAllByRole('listitem');

        expect(listItems).toHaveLength(1);
    });
});
