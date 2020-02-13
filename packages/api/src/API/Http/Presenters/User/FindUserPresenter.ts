import IPresenter from '../Base/IPresenter';

class FindUserPresenter implements IPresenter
{
	private message: string;
	private result: any;
	constructor(result: any, message: string) {
		this.result = result;
		this.message = message;
	}
	public toJson(): string {
		return JSON.stringify(this.getData());
	}
	public getData(): object {
		return { message: this.message, result: this.result };
	}
}

export default FindUserPresenter;
