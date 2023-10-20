import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import ShowPost from '.';

/* vi.mock('react-router-dom', () => ({
    ...vi.requireActual('react-router-dom'),
    useSearchParams: () => [new URLSearchParams({ ids: '001,002' })],
  })); */

const renderedComponent = () => {
    return render(
        <BrowserRouter>
            <ShowPost />
        </BrowserRouter>
    );
};

describe('Show page', () => {
    test('should display attributes page', () => {
        renderedComponent();
    });
});
