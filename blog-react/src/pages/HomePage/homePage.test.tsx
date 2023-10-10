import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import { faker } from '@faker-js/faker';
import HomePage from '.';
import LastPosts from '../../Components/Posts/LastPosts';
import * as useApiRequest from '../../hooks/useApiRequest';

const useApiRequestSpy = vi.spyOn(useApiRequest, 'useApiRequests');

const renderedComponent = () => {
    return render(
        <BrowserRouter>
            <LastPosts />
        </BrowserRouter>
    );
};

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

    test('LastPostsComponents should display loading...', () => {
        const dataSpy = {
            data: [{ id: 1, title: 'test-title', description: faker.lorem }],
            error: false,
            fetchData: vi.fn(),
            isLoading: true,
        };

        useApiRequestSpy.mockReturnValue(dataSpy);

        const { queryByText } = renderedComponent();

        expect(queryByText('Loading...')).toBeInTheDocument();
    });

    test('LastPostsComponents should display posts', async () => {
        const dataSpy = {
            data: [{ id: 1, title: 'test-title', description: faker.lorem }],
            error: false,
            fetchData: vi.fn(),
            isLoading: false,
        };

        useApiRequestSpy.mockReturnValue(dataSpy);

        const { findAllByRole } = renderedComponent();

        const listItems = await findAllByRole('listitem');

        expect(listItems).toHaveLength(1);
    });
});
