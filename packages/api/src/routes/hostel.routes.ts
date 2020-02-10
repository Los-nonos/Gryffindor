import container from '../Infraestructure/DI/inversify.config';
import asyncMiddleware from '../API/Http/Middleware/AsyncMiddleware';
import CreateHostelAction from '../API/Http/Actions/Hostel/CreateHostelAction';
import EditHostelAction from '../API/Http/Actions/Hostel/EditHostelAction';
import DeleteHostelAction from '../API/Http/Actions/Hostel/DeleteHostelAction';
import FindByIdHostelAction from '../API/Http/Actions/Hostel/FindByIdHostelAction';
import FindHostelAction from '../API/Http/Actions/Hostel/FindHostelAction';
import { Router, Request, Response, NextFunction } from 'express';
import { authMiddleware } from '../API/Http/Middleware/AuthenticationMiddleware';

const router = Router();

router.post(
  '/hostel',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<CreateHostelAction>(CreateHostelAction);
    await action.execute(req, res);
  }),
);

router.put(
  '/hostel/:id',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<EditHostelAction>(EditHostelAction);
    await action.execute(req, res);
  }),
);

router.get(
  '/hostel',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<FindHostelAction>(FindHostelAction);
    await action.execute(req, res);
  }),
);

router.get(
  '/hostel/:id',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<FindByIdHostelAction>(FindByIdHostelAction);
    await action.execute(req, res);
  }),
);

router.delete(
  '/hostel',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<DeleteHostelAction>(DeleteHostelAction);
    await action.execute(req, res);
  }),
);

export default router;
